import { test, expect } from '@playwright/test';
import path from 'path';

const folder = path.basename(__dirname);

test(`testing (${folder})`, async ({ page }) => {

	const jsErrors: string[] = [];
	const consoleErrors: string[] = [];

	page.on('pageerror', error => jsErrors.push(error.message));
	page.on('console', msg => {
		if (msg.type() === 'error') {
			consoleErrors.push(msg.text());
		}
	});

	const response = await page.goto(`/tests/e2e/${folder}/index.php`);
	expect(response?.ok()).toBeTruthy();

	await expect(page.locator('body')).toBeVisible();

	await page.waitForTimeout(2000);

	expect(jsErrors, 'JavaScript runtime errors detected').toHaveLength(0);
	expect(consoleErrors, 'console.error calls detected').toHaveLength(0);
});
