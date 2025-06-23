// @ts-nocheck
import { test, expect } from '@playwright/test';

test('homepage', async ({ page }) => {
  await page.goto('https://localhost/');
  await expect(page).toHaveTitle('Welcome to API Platform!');
});

test('swagger', async ({ page }) => {
  await page.goto('https://localhost/docs');
  await expect(page).toHaveTitle('Hello API Platform - API Platform');
  await expect(page.locator('.operation-tag-content > span')).toHaveCount(5);
});