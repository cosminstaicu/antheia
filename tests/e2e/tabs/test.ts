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
	await page.waitForTimeout(500);
	// click select 1
	await page.locator('#buttonSelect1').click();
	await page.waitForTimeout(500);
	await expect(page.locator('#tab1')).toContainClass('ant-selected');
	await expect(page.locator('#tab2')).not.toContainClass('ant-selected');
	await expect(page.locator('#tab3')).not.toContainClass('ant-selected');
	await expect(page.locator('#tab4')).not.toContainClass('ant-selected');
	// click select 2
	await page.locator('#buttonSelect2').click();
	await page.waitForTimeout(500);
	await expect(page.locator('#tab1')).not.toContainClass('ant-selected');
	await expect(page.locator('#tab2')).toContainClass('ant-selected');
	await expect(page.locator('#tab3')).not.toContainClass('ant-selected');
	await expect(page.locator('#tab4')).not.toContainClass('ant-selected');
	// click select 3
	await page.locator('#buttonSelect3').click();
	await page.waitForTimeout(500);
	await expect(page.locator('#tab1')).not.toContainClass('ant-selected');
	await expect(page.locator('#tab2')).not.toContainClass('ant-selected');
	await expect(page.locator('#tab3')).toContainClass('ant-selected');
	await expect(page.locator('#tab4')).not.toContainClass('ant-selected');
	// click rename
	await expect(page.locator('#tab1')).toContainText('Link with close');
	await page.locator('#buttonRename').click();
	await page.waitForTimeout(500);
	await expect(page.locator('#tab1')).toContainText('Renamed');
	// click hide
	await expect(page.locator('#tab2')).toBeVisible();
	await page.locator('#buttonHide').click();
	await page.waitForTimeout(500);
	await expect(page.locator('#tab2')).toBeHidden();
	// click show
	await page.locator('#buttonShow').click();
	await page.waitForTimeout(500);
	await expect(page.locator('#tab2')).toBeVisible();
	expect(jsErrors, 'JavaScript runtime errors detected').toHaveLength(0);
	expect(consoleErrors, 'console.error calls detected').toHaveLength(0);
});
