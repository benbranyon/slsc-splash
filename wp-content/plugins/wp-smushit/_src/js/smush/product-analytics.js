import MixPanel from '../mixpanel';

class ProductAnalytics {
	init() {
		this.trackUltraLinks();
		this.trackUpsellLinks();
	}

	trackUltraLinks() {
		const ultraUpsellLinks = document.querySelectorAll( '.wp-smush-upsell-ultra-compression' );
		if ( ! ultraUpsellLinks ) {
			return;
		}
		const getLocation = ( ultraLink ) => {
			const locations = {
				settings: 'bulksmush_settings',
				dashboard: 'dash_summary',
				bulk: 'bulksmush_summary',
				directory: 'directory_summary',
				'lazy-load': 'lazy_summary',
				cdn: 'cdn_summary',
				webp: 'webp_summary',
			};
			const locationId = ultraLink.classList.contains( 'wp-smush-ultra-compression-link' ) ? 'settings' : this.getCurrentPageSlug();
			return locations[ locationId ] || 'bulksmush_settings';
		};

		ultraUpsellLinks.forEach( ( ultraLink ) => {
			const eventName = 'ultra_upsell_modal';
			ultraLink.addEventListener( 'click', ( e ) => {
				MixPanel.getInstance().track( eventName, {
					Location: getLocation( e.target ),
					'Modal Action': 'direct_cta',
				} );
			} );
		} );
	}

	trackUpsellLinks() {
		const upsellLinks = document.querySelectorAll( '[href*="utm_source=smush"]' );
		if ( ! upsellLinks ) {
			return;
		}
		upsellLinks.forEach( ( upsellLink ) => {
			upsellLink.addEventListener( 'click', ( e ) => {
				const params = new URL( e.target.href ).searchParams;
				if ( ! params ) {
					return;
				}

				const campaign = params.get( 'utm_campaign' );
				const upsellLocations = {
					// CDN.
					summary_cdn: 'dash_summary',
					'smush-dashboard-cdn-upsell': 'dash_widget',
					smush_bulksmush_cdn: 'bulk_smush_progress',
					smush_cdn_upgrade_button: 'cdn_page',
					smush_bulksmush_library_gif_cdn: 'media_library',
					smush_bulk_smush_complete_global: 'bulk_smush_complete',

					// Local WebP.
					summary_local_webp: 'dash_summary',
					'smush-dashboard-local-webp-upsell': 'dash_widget',
					// smush_webp_upgrade_button: 'webp_page',// Handled inside React WebP - free-content.jsx
				};

				if ( ! ( campaign in upsellLocations ) ) {
					return;
				}

				const Location = upsellLocations[ campaign ];
				const matches = campaign.match( /(cdn|webp)/i );
				const upsellModule = matches && matches[ 0 ];

				const eventName = 'webp' === upsellModule ? 'local_webp_upsell' : 'cdn_upsell';
				MixPanel.getInstance().track( eventName, { Location } );
			} );
		} );
	}

	getCurrentPageSlug() {
		const searchParams = new URLSearchParams( document.location.search );
		const pageSlug = searchParams.get( 'page' );
		return 'smush' === pageSlug ? 'dashboard' : pageSlug.replace( 'smush-', '' );
	}
}

( new ProductAnalytics() ).init();
