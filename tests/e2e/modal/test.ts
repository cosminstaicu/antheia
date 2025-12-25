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
	// load the page
	const response = await page.goto(`/tests/e2e/${folder}/index.php`);
	expect(response?.ok()).toBeTruthy();
	await expect(page.locator('body')).toBeVisible();
	await page.waitForTimeout(500);
	// test the simple modal
	await page.click('#simpleModalButton');
	await page.waitForTimeout(1000);
	await expect(page.locator('#simpleModal')).toBeVisible();
	await page.locator('.ant_modal').first().click();
	await page.waitForTimeout(1000);
	await expect(page.locator('#simpleModal')).toHaveCount(0);
	// test the live content update
	await page.click('#contentUpdateModalButton');
	await page.waitForTimeout(1000);
	await expect(page.locator('#contentUpdateModal')).toBeVisible();
	await page.waitForTimeout(5000);
	await expect(page.locator('#contentUpdateModalCloseButton')).toBeVisible();
	await page.locator('.ant_modal').first().click();
	await page.waitForTimeout(1000);
	await expect(page.locator('#contentUpdateModal')).toHaveCount(0);
	// test the loading animation
	await page.click('#loadingModalButton');
	await page.waitForTimeout(1000);
	await expect(page.locator('#loadingModal')).toBeVisible();
	await page.waitForTimeout(5000);
	await expect(page.locator('#loadingModalCloseButton')).toBeVisible();
	await page.locator('.ant_modal').first().click();
	await page.waitForTimeout(1000);
	await expect(page.locator('#loadingModal')).toHaveCount(0);
	// test menu modal
	await page.click('#loadingModalButton');
	await page.waitForTimeout(1000);
	await expect(page.locator('#menuModal')).toBeVisible();
	await expect(page.locator('#modalMenuItem1')).toBeVisible();
	await expect(page.locator('#modalMenuItem2')).toBeVisible();
	await expect(page.locator('#modalMenuItem3')).toBeVisible();
	await page.locator('#modalMenuItem3').first().click();
	await page.waitForTimeout(500);
	await expect(page.locator('#modalMenuItem3')).toBeVisible();
	await page.locator('#modalMenuItem1').click();
	await page.waitForTimeout(1000);
	await expect(page.locator('#menuModal')).toHaveCount(0);
	// finish
	expect(jsErrors, 'JavaScript runtime errors detected').toHaveLength(0);
	expect(consoleErrors, 'console.error calls detected').toHaveLength(0);
});
