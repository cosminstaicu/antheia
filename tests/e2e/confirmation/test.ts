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
	// a full page image should be fisible
	await expect(page.getByTestId('ant_message_image')).toBeVisible();
	// wait for the full page confirmation to be removed
	await page.waitForTimeout(3000);
	await expect(page.getByTestId('ant_message_image')).toHaveCount(0);
	// test full page message
	await page.locator('#buttonFullPage').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_message_image')).toBeVisible();
	await page.waitForTimeout(3000);
	await expect(page.getByTestId('ant_message_image')).toHaveCount(0);
	// test full page image with close on click
	await page.locator('#buttonFullPageCloseOnClick').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_message_image')).toBeVisible();
	await page.getByTestId('ant_message_image').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_message_image')).toBeHidden();
	// test small message
	await page.locator('#buttonSmallMessage').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_message_text')).toBeVisible();
	await page.waitForTimeout(4500);
	await expect(page.getByTestId('ant_message_text')).toHaveCount(0);
	// click info type alert
	await page.locator('#buttonInfoAlert').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_alert_infoModal')).toBeVisible();
	await page.getByTestId('ant_alert_okButton').click();
	await page.waitForTimeout(1000);
	await expect(page.getByTestId('ant_modal')).toHaveCount(0);
	// click error type alert
	await page.locator('#buttonErrorAlert').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_alert_errorModal')).toBeVisible();
	// click outside the alert, the modal should start removing
	await page.getByTestId('ant_modal').click();
	await page.waitForTimeout(1000);
	await expect(page.getByTestId('ant_modal')).toHaveCount(0);
	// click confirmation
	await page.locator('#buttonErrorAlert').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_confirm_confirmModal')).toBeVisible();
	// confirmation yes
	await page.getByTestId('ant_confirm_okButton').click();
	await page.waitForTimeout(1000);
	await expect(page.getByTestId('ant_modal')).toHaveCount(0);
	// click confirmation
	await page.locator('#buttonErrorAlert').click();
	await page.waitForTimeout(500);
	await expect(page.getByTestId('ant_confirm_confirmModal')).toBeVisible();
	// confirmation no
	await page.getByTestId('ant_confirm_cancelButton').click();
	await page.waitForTimeout(1000);
	await expect(page.getByTestId('ant_modal')).toHaveCount(0);
	// finish
	expect(jsErrors, 'JavaScript runtime errors detected').toHaveLength(0);
	expect(consoleErrors, 'console.error calls detected').toHaveLength(0);
});
