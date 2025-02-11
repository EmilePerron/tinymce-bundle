import { test, expect } from '@playwright/test';

test.describe('With Javascript', () => {
	test('Form type', async ({ page }) => {
		await page.goto('http://localhost/test/form');

		// Validate initial content
		await expect(page.frameLocator('iframe[title="Rich Text Area"]').getByText('Initial text value')).toBeVisible();

		// Validate YAML configuration-provided attribute
		await expect(page.getByLabel('Bold')).toBeVisible();

		// Validate user-provided attribute
		await expect(page.locator('button').filter({ hasText: 'Format' })).toBeVisible();

		// Update the content and submit the form
		await page.frameLocator('iframe[title="Rich Text Area"]').getByLabel('Rich Text Area. Press ALT-0').fill('Initial text value has been updated!');
		await page.getByRole('button', { name: 'Submit' }).click();

		// Validate form data is received correctly
		await expect(page.getByText('Initial text value has been updated!')).toBeVisible();
	});

	test('Template', async ({ page }) => {
		await page.goto('http://localhost/test/template');

		// Validate initial content
		await expect(page.frameLocator('iframe[title="Rich Text Area"]').getByText('Initial text value')).toBeVisible();

		// Validate YAML configuration-provided attribute
		await expect(page.getByLabel('Bold')).toBeVisible();

		// Validate user-provided attribute
		await expect(page.locator('button').filter({ hasText: 'Format' })).toBeVisible();
	});

	test('Javascript', async ({ page }) => {
		await page.goto('http://localhost/test/javascript');

		// Validate initial content
		await expect(page.frameLocator('iframe[title="Rich Text Area"]').getByText('Initial text value')).toBeVisible();

		// Validate YAML configuration-provided attribute
		await expect(page.getByLabel('Bold')).toBeVisible();

		// Validate user-provided attribute
		await expect(page.locator('button').filter({ hasText: 'Format' })).toBeVisible();
	});
});
