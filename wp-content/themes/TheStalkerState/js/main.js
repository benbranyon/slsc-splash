const C = CANNON;
const perspective = 400;

const map = (value, min1, max1, min2, max2) => min2 + (max2 - min2) * (value - min1) / (max1 - min1);

// MAIN SCENE

class Scene {
  constructor() {
    this.$container = document.getElementById("stage");

    this.W = window.innerWidth;
    this.H = window.innerHeight;

    this.world = new C.World();
    this.world.gravity.set(0, -40, 0);

    this.clock = new THREE.Clock();

    this.setup();
    this.bindEvents();
  }

  bindEvents() {
    window.addEventListener("resize", () => {
      this.onResize();
    });
  }

  // Setups

  setup() {
    this.scene = new THREE.Scene();

    this.setCamera();
    this.setLights();
    this.setRender();

    this.setControls();

    // this.dbr = new CannonDebugRenderer(this.scene, this.world);

    this.addObjects();

  }

  setRender() {
    this.renderer = new THREE.WebGLRenderer({
      antialias: true,
      alpha: true,
      canvas: this.$container 
    });

    this.renderer.setClearColor(0x0e141c, 0);
    this.renderer.setSize(this.W, this.H);
    this.renderer.setPixelRatio(window.devicePixelRatio);

    this.renderer.setAnimationLoop(() => {
      this.draw();
    });
  }

  setCamera() {
    const fov = 180 * (2 * Math.atan(this.H / 2 / perspective)) / Math.PI;

    this.camera = new THREE.PerspectiveCamera(fov, this.W / this.H, 1, 10000);
    this.camera.position.set(0, 0, perspective);
  }

  setLights() {
    const ambient = new THREE.DirectionalLight(0x999999);
    this.scene.add(ambient);

    const light = new THREE.PointLight(0x08d4fc, 0.4);
    light.position.set(200, 200, 400);
    this.scene.add(light);
  }

  setControls() {
    //this.controls = new OrbitControls(this.camera, this.renderer.domElement);
    //this.controls.enableKeys = false;
    //this.controls.update();
  }

  // Actions

  addObjects() {
    this.andre = new Andre(this.scene, this.world);
  }

  // Loop
  draw() {
    this.andre.update();
    this.updatePhysics();
    this.renderer.render(this.scene, this.camera);
  }

  updatePhysics() {
    // this.dbr.update()
    this.world.step(1 / 60, this.clock.getDelta(), 1000);
  }

  // Handlers
  onResize() {
    this.W = window.innerWidth;
    this.H = window.innerHeight;

    this.camera.aspect = this.W / this.H;

    this.camera.updateProjectionMatrix();
    this.renderer.setSize(this.W, this.H);
  }}


// Andre
class Andre {
  constructor(scene, world) {
    this.scene = scene;
    this.world = world;

    this.options = {
      branchs: 6,
      radius: 30,
      size: 8,
      lengthTentacles: 25,
      rows: 6,
      cols: 7,
      color: "#08d4fc" };


    this.angle = new THREE.Vector2();
    this.mouse = new THREE.Vector2();

    this.setup();
    this.createSphere();

    this.createPivots();
    this.createTentacles();

    this.bindEvents();
  }

  bindEvents() {
    window.addEventListener("mousemove", e => {
      this.onMouseMove(e);
    });
  }

  setup() {
    this.noFrictionMat = new C.Material();
    this.sphereMat = new C.Material();
    this.pivotMat = new C.Material();

    this.zeroVec = new C.Vec3(0, 0, 0);

    this.dummy = new THREE.Object3D();
    this.shapeWorldPosition = new THREE.Vector3();
    this.shapeWorldQuaternion = new THREE.Vector3();

    const tentaclesContactMaterial = new C.ContactMaterial(
    this.noFrictionMat,
    this.noFrictionMat,
    {
      friction: 0.3,
      restitution: 0.3,
      contactEquationStiffness: 1e7,
      contactEquationRelaxation: 3,
      frictionEquationStiffness: 1e7,
      frictionEquationRelaxation: 3 });



    const spherePivotContactMat = new C.ContactMaterial(
    this.sphereMat,
    this.pivotMat,
    {
      friction: 0 });



    this.world.addContactMaterial(spherePivotContactMat);
    this.world.addContactMaterial(tentaclesContactMaterial);
  }

  // Handlers

  onMouseMove(event) {
    TweenMax.to(this.angle, 50, {
      x: (event.clientX / window.innerWidth * 2 - 1) * Math.PI * 2,
      y: (-(event.clientY / window.innerHeight) * 2 + 1) * Math.PI * 2 });
      let middlehalf = window.innerHeight / 2;
      let middlehoriz = window.innerWidth / 2;
      if (event.clientY > middlehalf && event.clientX > middlehoriz) {
          this.world.gravity.set(40, -40, 0);
      } else if (event.clientY > middlehalf && event.clientX < middlehoriz) {
          this.world.gravity.set(-40, -40, 0)
      } else if (event.clientY < middlehalf && event.clientX < middlehoriz) {
          this.world.gravity.set(-40, 40, 0);
      } else if (event.clientY < middlehalf && event.clientX > middlehoriz) {
          this.world.gravity.set(40, 40, 0);
      }

  }

  // Actions

  createSphere() {
    const { radius, rows, cols, color } = this.options;
    const geo = new THREE.SphereBufferGeometry(radius, rows, cols);
    const mat = new THREE.MeshLambertMaterial({ color });

    this.mesh = new THREE.Mesh(geo, mat);
    this.mesh.body = new C.Body({
      mass: 0,
      type: C.Body.DYNAMIC,
      position: new C.Vec3(0, 0, 0),
      shape: new C.Sphere(radius),
      material: this.sphereMat });

    this.world.addBody(this.mesh.body);
    this.scene.add(this.mesh);
  }

  createPivots() {
    const { rows, cols, radius } = this.options;
    const pivotShape = new C.Sphere(1);

    if (this.pivots) {
      this.pivots.forEach(pivot => {
        this.world.removeBody(pivot);
      });
    }

    this.pivots = [];

    // Set Pivots points around sphere
    for (let row = 0; row < rows; row++) {
      const lat = map(row, 0, rows, Math.PI * 0.1, Math.PI);

      for (let col = 0; col < cols; col++) {
        const lon = map(col, 0, cols, 0, Math.PI * 2);
        const x = radius * Math.sin(lat) * Math.cos(lon);
        const y = radius * Math.sin(lat) * Math.sin(lon);
        const z = radius * Math.cos(lat);

        const pivot = new C.Body({
          mass: 0,
          type: C.Body.DYNAMIC,
          material: this.pivotMat,
          position: this.zeroVec });


        pivot.addShape(pivotShape, new C.Vec3(x, y, z));

        this.pivots.push(pivot);
        //this.world.addBody(pivot);
      }
    }
  }

  createTentacles() {
    const {
      rows,
      cols,
      radius,
      color,
      branchs,
      size,
      lengthTentacles } =
    this.options;

    if (this.tentacles) {
      this.tentacles.forEach(branch => {
        this.scene.remove(branch);
      });
    }

    if (this.bodies) {
      this.bodies.forEach(body => {
        this.world.removeBody(body);
        this.world.removeConstraint(body.constraint);
      });
    }

    this.tentacles = [];
    this.bodies = [];

    // Instanciate branches
    for (let i = 0, maxw = size; i < branchs; i++) {
      const branch = new THREE.InstancedMesh(
      new THREE.CylinderBufferGeometry(
      maxw * 0.75,
      maxw,
      lengthTentacles * 2,
      6),

      new THREE.MeshLambertMaterial({ 
        color: color
      }),
      rows * cols * branchs);


      maxw *= 0.6;

      this.tentacles.push(branch);
    }

    // Create visible branchs
    const shapeWorldPosition = new C.Vec3();
    const mat = new THREE.Matrix4();
    let k = 0;

    const fixedQuat = new THREE.Quaternion();
    fixedQuat.setFromAxisAngle(new THREE.Vector3(0, 1, 0), Math.PI * 0.5);

    this.pivots.forEach((pivot, i) => {
      const dummy = new THREE.Object3D();
      let maxw = size;

      // Get world position
      pivot.quaternion.vmult(pivot.shapeOffsets[0], shapeWorldPosition);
      pivot.position.vadd(shapeWorldPosition, shapeWorldPosition);
      pivot.normal = shapeWorldPosition.unit(new C.Vec3());

      mat.makeTranslation(
      shapeWorldPosition.x,
      shapeWorldPosition.y,
      shapeWorldPosition.z);


      const cnormal = new THREE.Vector3(
      pivot.normal.x,
      pivot.normal.y,
      pivot.normal.z);


      dummy.lookAt(cnormal);
      dummy.applyMatrix(mat);

      for (let j = 0; j < branchs; j++) {
        const box = new C.Cylinder(maxw * 1.2, maxw, lengthTentacles * 2, 3);

        const tempQ = new C.Quaternion();
        tempQ.setFromAxisAngle(C.Vec3.UNIT_X, Math.PI * -0.5);

        box.transformAllPoints(new C.Vec3(), tempQ);

        const br = this.tentacles[j];
        const other = j > 0 ? this.bodies[k - 1] : pivot;
        const position = shapeWorldPosition.vadd(
        pivot.normal.clone().scale(lengthTentacles * 2 * j));

        const pivotA = j > 0 ? new C.Vec3(0, lengthTentacles, 0) : position;
        const pivotB = new C.Vec3(0, -lengthTentacles, 0);

        const dum = new THREE.Object3D();
        const tempM = new THREE.Quaternion();
        tempM.setFromAxisAngle(new THREE.Vector3(1, 0, 0), Math.PI * 0.5);

        dum.lookAt(cnormal);
        dum.quaternion.multiply(tempM);

        const body = new C.Body({
          mass: 1,
          shape: box,
          material: this.noFrictionMat,
          position,
          angularDamping: 0.9,
          linearDamping: 0.9,
          quaternion: dum.quaternion });


        this.bodies.push(body);
        this.world.addBody(body);

        br.setMatrixAt(k, dummy.matrix);
        br.instanceMatrix.needsUpdate = true;

        body.constraint = new C.ConeTwistConstraint(other, body, {
          pivotA,
          pivotB,
          axisA: C.Vec3.UNIT_Y,
          axisB: C.Vec3.UNIT_Y,
          angle: Math.PI / 12,
          twistAngle: Math.PI / 12 });

        //body.constraint.collideConnected = true;

        this.world.addConstraint(body.constraint);

        maxw *= 0.4;
        k++;
        this.scene.add(br);
      }
    });
  }

  // Loop
  update() {
    this.mesh.body.quaternion.setFromEuler(-this.angle.y, this.angle.x, 0);
    this.mesh.quaternion.copy(this.mesh.body.quaternion);

    const shapeWorldPosition = this.shapeWorldPosition;
    const shapeWorldQuaternion = this.shapeWorldQuaternion;

    let k = 0;
    this.pivots.forEach((pivot, i) => {
      pivot.quaternion.copy(this.mesh.body.quaternion);

      this.tentacles.forEach(branch => {
        const dummy = this.dummy;
        const body = this.bodies[k];

        // Get world position
        body.quaternion.vmult(body.shapeOffsets[0], shapeWorldPosition);
        body.position.vadd(shapeWorldPosition, shapeWorldPosition);

        // Get world quaternion
        body.quaternion.mult(body.shapeOrientations[0], shapeWorldQuaternion);

        // Copy to meshes
        dummy.position.copy(shapeWorldPosition);
        dummy.quaternion.copy(shapeWorldQuaternion);

        dummy.updateMatrix();

        branch.setMatrixAt(k, dummy.matrix);
        branch.instanceMatrix.needsUpdate = true;
        k++;
      });
    });
  }

  updateMaterial() {
    this.mesh.material.setValues({
      color: this.options.color });


    this.tentacles.forEach(branch => {
      branch.material.setValues({
        color: this.options.color });

    });
  }

  updateGeometry() {
    const { radius, rows, cols } = this.options;

    this.world.removeBody(this.mesh.body);

    this.mesh.geometry.dispose();
    this.mesh.geometry = new THREE.SphereBufferGeometry(radius, rows, cols);

    this.mesh.body = new C.Body({
      mass: 0,
      type: C.Body.DYNAMIC,
      position: new C.Vec3(0, 0, 0),
      shape: new C.Sphere(radius),
      material: this.sphereMat });


    this.world.addBody(this.mesh.body);

    this.createPivots();
    this.createTentacles();
  }

  updateConstraint() {}}

window.addEventListener('load', function () {
  window.Scene = new Scene();
});