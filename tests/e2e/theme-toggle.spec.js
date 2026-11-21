/**
 * The plugin adds a «Themes» menu to the admin bar that lists every installed theme, marks the active one, and
 * switches theme in one click, returning to the page it was clicked on. The active theme is restored afterwards.
 */
import { test, expect } from '@wordpress/e2e-test-utils-playwright';

const MENU = '#wp-admin-bar-theme-toggle';

async function openMenu( page ) {
	await page.locator( MENU ).hover();
	await expect( page.locator( `${ MENU } .ab-submenu` ) ).toBeVisible();
}

test.describe( 'Theme Toggle', () => {
	let themes;
	let originalTheme;

	test.beforeAll( async ( { requestUtils } ) => {
		themes = await requestUtils.rest( { path: '/wp/v2/themes' } );
		originalTheme = themes.find( ( theme ) => theme.status === 'active' )
			.stylesheet;
	} );

	test.afterAll( async ( { requestUtils } ) => {
		await requestUtils.activateTheme( originalTheme );
	} );

	test( 'adds a Themes menu to the admin bar', async ( { page } ) => {
		await page.goto( '/' );
		await expect( page.locator( `${ MENU } .ab-label` ) ).toHaveText(
			'Themes'
		);
	} );

	test( 'lists every installed theme and marks the active one', async ( {
		page,
	} ) => {
		await page.goto( '/' );
		await openMenu( page );
		const items = page.locator( `${ MENU } .ab-submenu li.theme-toggle` );
		await expect( items ).toHaveCount( themes.length );
		const active = page.locator(
			`${ MENU } .ab-submenu li.theme-toggle.is-active`
		);
		await expect( active ).toHaveCount( 1 );
		await expect( active ).toHaveAttribute(
			'id',
			`wp-admin-bar-theme-${ originalTheme }`
		);
	} );

	test( 'switches theme and returns to the same page', async ( {
		page,
		requestUtils,
	} ) => {
		const other = themes.find( ( theme ) => theme.status !== 'active' );
		expect( other, 'needs a second installed theme' ).toBeTruthy();

		// The Hello World post, at whatever URL the site's permalinks give it.
		await page.goto( '/?p=1' );
		const postUrl = page.url();
		await openMenu( page );
		await page.locator( `#wp-admin-bar-theme-${ other.stylesheet } a` ).click();

		await expect( page ).toHaveURL( postUrl );
		const now = await requestUtils.rest( {
			path: '/wp/v2/themes',
			params: { status: 'active' },
		} );
		expect( now[ 0 ].stylesheet ).toBe( other.stylesheet );
		await openMenu( page );
		await expect(
			page.locator( `${ MENU } .ab-submenu li.theme-toggle.is-active` )
		).toHaveAttribute( 'id', `wp-admin-bar-theme-${ other.stylesheet }` );
	} );
} );
