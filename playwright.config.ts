import { defineConfig } from '@playwright/test';

export default defineConfig({
	testDir: './playwright',
	timeout: 30_000,

	use: {
		headless: true,
		screenshot: 'only-on-failure',
		video: 'retain-on-failure',
		trace: 'retain-on-failure',
	},

	reporter: [
		['list'],
		['html', { open: 'never' }]
	],
});
