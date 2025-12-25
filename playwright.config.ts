import { defineConfig } from '@playwright/test';

export default defineConfig({
	testDir: 'tests/e2e',
	testMatch: '**/test.ts',
	
	timeout: 30_000,

	use: {
		baseURL: 'http://127.0.0.1:8000',
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
