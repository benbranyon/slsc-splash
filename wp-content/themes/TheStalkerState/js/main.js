// three.js variables
var mesh, mesh2, mesh3, camera, scene, renderer;
var maxRotation = 4 * Math.PI;
let theta = 0;
const radius = 100;

// Click handlers
function objectClickHandler() {
    var link = "/architecture-of-surveillance-landing/"
    window.location.href = link;
}

function objectClickHandler2() {
    var link = "/architecture-of-surveillance-landing/"
    window.location.href = link;
}

function objectClickHandler3() {
    var link = "/architecture-of-surveillance-landing/"
    window.location.href = link;
}

function onWindowResize() {
    var container = document.getElementById('scene-container');
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();

    renderer.setSize(container.clientWidth, container.clientHeight);
}

function init() {
    var container = document.getElementById('scene-container');
    camera = new THREE.PerspectiveCamera(70, container.clientWidth / container.clientHeight, 1, 1000);
    camera.position.z = 300;

    scene = new THREE.Scene();
    //scene.background = new THREE.Color( 0x000000, 0 );

    const light = new THREE.DirectionalLight( 0xffffff, 1 );
    light.position.set( 1, 100, 1 ).normalize();
    scene.add( light );

    //var lightAmb = new THREE.AmbientLight(0x777777);
    //scene.add(lightAmb);
    
    var material = new THREE.MeshPhongMaterial({
      color: 0x2194ce,
      specular: 0x111111,
      shininess: 50,
      wireframe: true
    });

    var material2 = new THREE.MeshPhongMaterial({
      color: 0x2194ce,
      specular: 0x111111,
      shininess: 50,
    });

    const texture = new THREE.TextureLoader().load( '/wp-content/themes/GutenbergStarterChild/assets/textures/earth-lights-texture.png' );

    var material3 = new THREE.MeshPhongMaterial({
      map: texture,      
    });

    var objectSize = 100;
    
    // Create a cube
    //var boxGeometry = new THREE.BoxGeometry(objectSize, objectSize, objectSize);
    //mesh = new THREE.Mesh(boxGeometry, material);
    //mesh.position.set(objectSize * -2, 0, 0);
    //mesh.callback = objectClickHandler;

    // create a sphere
    var sphereGeometry = new THREE.SphereGeometry( objectSize / 2, 32, 32 );
    mesh = new THREE.Mesh(sphereGeometry, material2);
    mesh.position.set(objectSize * -2, 0, 0);
    //mesh.position.x = Math.random() * 500 - 400;
    //mesh.position.y = Math.random() * 500 -400;
    //mesh.position.z = Math.random() * 500 - 400;
    mesh.callback = objectClickHandler;

    mesh2 = new THREE.Mesh(sphereGeometry, material3);
    mesh2.position.set(0, 0, 0);
    //mesh2.position.x = Math.random() * 800 - 400;
    //mesh2.position.y = Math.random() * 800 -400;
    //mesh2.position.z = Math.random() * 800 - 400;
    mesh2.callback = objectClickHandler2;

    mesh3 = new THREE.Mesh(sphereGeometry, material);
    mesh3.position.set(objectSize, 0, 0);
    //mesh3.position.x = Math.random() * 800 - 400;
    //mesh3.position.y = Math.random() * 800 -400;
    //mesh3.position.z = Math.random() * 800 - 400;
    mesh3.callback = objectClickHandler3;

    // create a cylinder
    //var cylinderGeometry = new THREE.CylinderGeometry( objectSize / 4, objectSize / 4, 64, 32 );
    //mesh3 = new THREE.Mesh(cylinderGeometry, material);
    //mesh3.position.set(objectSize * 2, 0, 0);
    //mesh3.callback = objectClickHandler;

    scene.add(mesh);
    scene.add(mesh2);
    scene.add(mesh3);

    renderer = new THREE.WebGLRenderer({
        alpha: true
    });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(container.clientWidth, container.clientHeight);
    container.appendChild(renderer.domElement);

    window.addEventListener('resize', onWindowResize, false);
}

function animate() {
    requestAnimationFrame(animate);

    mesh.rotation.y = (mesh.rotation.y + 0.005) % maxRotation;
    mesh2.rotation.y = (mesh2.rotation.x + 0.005) % maxRotation;
    mesh3.rotation.y = (mesh3.rotation.y + 0.005) % maxRotation;
    mesh3.rotation.x = (mesh3.rotation.x + 0.005) % maxRotation;

    theta += 0.2;
    camera.position.x = radius * Math.sin( THREE.MathUtils.degToRad( theta ) );
    camera.position.y = radius * Math.sin( THREE.MathUtils.degToRad( theta ) );
    camera.position.z = radius * Math.cos( THREE.MathUtils.degToRad( theta ) );
    camera.lookAt( scene.position );

    camera.updateMatrixWorld();
    
    renderer.render(scene, camera);
}

window.addEventListener('load', function () {
    //init();
    //animate();

    var raycaster = new THREE.Raycaster();
    var mouse = new THREE.Vector2();

    // See https://stackoverflow.com/questions/12800150/catch-the-click-event-on-a-specific-mesh-in-the-renderer
    // Handle all clicks to determine of a three.js object was clicked and trigger its callback
    function onDocumentMouseDown(event) {
        event.preventDefault();

        mouse.x = (event.clientX / renderer.domElement.clientWidth) * 2 - 1;
        mouse.y =  - (event.clientY / renderer.domElement.clientHeight) * 2 + 1;

        raycaster.setFromCamera(mouse, camera);

        meshObjects = [mesh, mesh2, mesh3]; // three.js objects with click handlers we are interested in
        
        var intersects = raycaster.intersectObjects(meshObjects);

        if (intersects.length > 0) {
            intersects[0].object.callback();
        }

    }

    // Using the same logic as above, determine if we are currently mousing over a three.js object,
    // and adjust the animation to provide visual feedback accordingly
    function onDocumentMouseMove(event) {
        event.preventDefault();

        var rect = renderer.domElement.getBoundingClientRect();
        mouse.x = ( ( event.clientX - rect.left ) / ( rect.width - rect.left ) ) * 2 - 1;
        mouse.y = - ( ( event.clientY - rect.top ) / ( rect.bottom - rect.top) ) * 2 + 1;

        raycaster.setFromCamera(mouse, camera);

        var intersects = raycaster.intersectObjects([mesh, mesh2, mesh3]);
        var canvas = document.body.getElementsByTagName('canvas')[0];

        if (intersects.length > 0) {
            intersects[0].object.rotation.x += .05;
            canvas.style.cursor = "pointer";
        } else {
            canvas.style.cursor = "default";
        }

    }

    document.addEventListener('mousedown', onDocumentMouseDown, false);
    document.addEventListener('mousemove', onDocumentMouseMove, false);
}, false);
