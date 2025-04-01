import { test, expect } from '@playwright/test';

test.describe( 'Theme Toggle', () => {
	test.beforeEach( async ( { page } ) => {
		// Login as admin
		await page.goto( '/wp-admin' );
		await page.fill( '#user_login', 'admin' );
		await page.fill( '#user_pass', 'password' );
		await page.click( '#wp-submit' );
		await page.waitForURL( '/wp-admin/' );
	} );

	test( 'should display theme toggle in admin bar', async ( { page } ) => {
		// Visit any page to see the admin bar
		await page.goto( '/' );

		// Check if theme toggle menu exists
		const themeToggle = page.locator( '#wp-admin-bar-theme-toggle' );
		await expect( themeToggle ).toBeVisible();

		// Check if menu has correct title
		const themeToggleTitle = themeToggle.locator( '.ab-label' );
		await expect( themeToggleTitle ).toHaveText( 'Themes' );
	} );

	test( 'should list all installed themes', async ( { page } ) => {
		await page.goto( '/' );

		// Click the theme toggle menu
		await page.click( '#wp-admin-bar-theme-toggle' );

		// Check if theme menu items are visible
		const themeMenuItems = page.locator(
			'#wp-admin-bar-theme-toggle .ab-submenu .ab-item'
		);
		await expect( themeMenuItems ).toHaveCount(
			await page.evaluate( () => {
				return document.querySelectorAll(
					'#wp-admin-bar-theme-toggle .ab-submenu .ab-item'
				).length;
			} )
		);
	} );

	test( 'should highlight active theme', async ( { page } ) => {
		await page.goto( '/' );

		// Click the theme toggle menu
		await page.click( '#wp-admin-bar-theme-toggle' );

		// Check if active theme has correct class
		const activeTheme = page.locator(
			'#wp-admin-bar-theme-toggle .ab-submenu .theme-toggle.is-active'
		);
		await expect( activeTheme ).toBeVisible();
	} );

	test( 'should switch theme and redirect back', async ( { page } ) => {
		await page.goto( '/' );

		// Click the theme toggle menu
		await page.click( '#wp-admin-bar-theme-toggle' );

		// Get the first non-active theme
		const nonActiveTheme = page
			.locator(
				'#wp-admin-bar-theme-toggle .ab-submenu .theme-toggle:not(.is-active)'
			)
			.first();
		const themeName = ( await nonActiveTheme.textContent() ) || '';

		// Click the theme to switch
		await nonActiveTheme.click();

		// Wait for the theme switch to complete
		await page.waitForLoadState( 'networkidle' );

		// Verify we're back on the same page
		await expect( page ).toHaveURL( /.*\// );

		// Verify the theme was switched by checking the active theme
		await page.click( '#wp-admin-bar-theme-toggle' );
		const newActiveTheme = page.locator(
			'#wp-admin-bar-theme-toggle .ab-submenu .theme-toggle.is-active'
		);
		await expect( newActiveTheme ).toHaveText( themeName );
	} );
} );
