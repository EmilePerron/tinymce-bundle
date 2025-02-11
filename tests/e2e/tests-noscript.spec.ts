import { test, expect } from '@playwright/test';
test.use({ javaScriptEnabled: false });

test.describe('Without Javascript', () => {
	test('Form type', async ({ page }) => {
		await page.goto('http://localhost/test/form');

		const textarea = page.getByRole('textbox').getByText('Initial text value');

		// Validate fallback textarea is present and has initial content
		await expect(textarea).toBeVisible();
		await expect(textarea).toHaveValue('<p>Initial text value</p>');
		// Update the content and submit the form
		await textarea.fill('Initial text value has been updated!');
		await page.getByRole('button', { name: 'Submit' }).click();

		// Validate form data is received correctly
		await expect(page.getByText('Initial text value has been updated!')).toBeVisible();
	});
});
