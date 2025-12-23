import { test, expect } from '@playwright/test';
import fs from 'fs';
import path from 'path';

const e2eDir = path.join(process.cwd(), 'tests', 'e2e');

const testFolders = fs
	.readdirSync(e2eDir)
	.filter(name => {
	const fullPath = path.join(e2eDir, name);

	if (!fs.statSync(fullPath).isDirectory()) {
		return false;
	}

	// Skip helper and cache folders
	if (name.startsWith('_')) {
		return false;
	}

	return fs.existsSync(path.join(fullPath, 'index.php'));
});

for (const folder of testFolders) {
	test(`E2E: ${folder}`, async ({ page }) => {
		const url = `http://127.0.0.1:8000/tests/e2e/${folder}/index.php`;

		const jsErrors: string[] = [];
		page.on('pageerror', err => jsErrors.push(err.message));

		const response = await page.goto(url);
		expect(response?.ok()).toBeTruthy();

		await expect(page.locator('body')).toBeVisible();
		await page.waitForLoadState('networkidle');

		expect(jsErrors).toHaveLength(0);
	});
}
