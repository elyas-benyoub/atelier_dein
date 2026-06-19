const fs = require('fs');
const path = require('path');
const { test, expect } = require('@playwright/test');
const AxeBuilder = require('@axe-core/playwright').default;

const screenshotsDir = path.join(__dirname, '..', 'screenshots');
const viewports = [
  { name: 'mobile', width: 375, height: 812 },
  { name: 'tablette', width: 768, height: 1024 },
  { name: 'desktop', width: 1440, height: 900 }
];

const pages = [
  { name: 'accueil', url: '/', title: /Atelier Dein/ },
  { name: 'login', url: '/auth/login', title: /Connexion - Atelier Dein/, formSelector: 'form.auth-form' },
  { name: 'register', url: '/auth/register', title: /Inscription - Atelier Dein/, formSelector: 'form.auth-form' }
];

const adminCredentials = {
  email: process.env.E2E_ADMIN_EMAIL || 'admin@example.com',
  password: process.env.E2E_ADMIN_PASSWORD || 'password123'
};

const mediaTypes = [
  { name: 'film', section: /Films/, expectedText: /Classification/ },
  { name: 'livre', section: /Livres/, expectedText: /Synopsis/ },
  { name: 'jeu', section: /Jeux/, expectedText: /PEGI/ }
];

test.beforeAll(() => {
  fs.mkdirSync(screenshotsDir, { recursive: true });
});

async function assertNoHorizontalOverflow(page) {
  await page.waitForTimeout(700);
  const hasHorizontalOverflow = await page.evaluate(() =>
    document.documentElement.scrollWidth > window.innerWidth + 1
  );
  expect(hasHorizontalOverflow).toBeFalsy();
}

async function assertNoBlockingAxeViolations(page) {
  const accessibility = await new AxeBuilder({ page })
    .withTags(['wcag2a', 'wcag2aa', 'wcag21aa'])
    .analyze();
  const blockingViolations = accessibility.violations.filter((violation) =>
    ['critical', 'serious'].includes(violation.impact)
  );

  expect(
    blockingViolations,
    blockingViolations.map((violation) => `${violation.id}: ${violation.help}`).join('\n')
  ).toEqual([]);
}

async function loginAsAdmin(page) {
  await page.goto('/auth/login', { waitUntil: 'domcontentloaded' });
  await page.getByLabel('Adresse email', { exact: true }).fill(adminCredentials.email);
  await page.getByLabel('Mot de passe', { exact: true }).fill(adminCredentials.password);
  await Promise.all([
    page.waitForURL(/\/home$/),
    page.getByRole('button', { name: 'Se connecter' }).click()
  ]);
}

async function getMediaDetailUrl(page, sectionName) {
  await page.goto('/', { waitUntil: 'domcontentloaded' });
  const section = page.locator('.media-section').filter({
    has: page.getByRole('heading', { name: sectionName })
  });
  const mediaLink = section.locator('a.card-link').first();
  await expect(mediaLink).toBeVisible();
  return mediaLink.getAttribute('href');
}

for (const viewport of viewports) {
  test.describe(`${viewport.name} (${viewport.width}x${viewport.height})`, () => {
    for (const target of pages) {
      test(`${target.name} est visible sans débordement horizontal`, async ({ page }) => {
        await page.setViewportSize(viewport);
        await page.goto(target.url, { waitUntil: 'domcontentloaded' });
        await expect(page).toHaveTitle(target.title);
        await expect(page.locator('body')).toBeVisible();
        await expect(page.locator('h1')).toHaveCount(1);

        if (target.formSelector) {
          await expect(page.locator(target.formSelector)).toBeVisible();
          await expect(page.getByLabel('Adresse email', { exact: true })).toBeVisible();
          await expect(page.getByLabel('Mot de passe', { exact: true })).toBeVisible();
        }

        if (target.name === 'accueil') {
          await expect(page.getByLabel('Rechercher un média')).toBeVisible();
          await expect(page.getByLabel('Filtrer par type de média')).toBeVisible();
        }

        await assertNoHorizontalOverflow(page);

        await page.screenshot({
          path: path.join(screenshotsDir, `${viewport.name}-${target.name}.png`),
          fullPage: true
        });

        if (target.name === 'accueil' && viewport.name === 'mobile') {
          const menuToggle = page.locator('.menu-toggle');
          await menuToggle.focus();
          await page.keyboard.press('Enter');
          await expect(menuToggle).toHaveAttribute('aria-expanded', 'true');
          await expect(page.locator('#primary-navigation')).toHaveClass(/active/);
          await page.keyboard.press('Escape');
          await expect(menuToggle).toHaveAttribute('aria-expanded', 'false');
        }

        await assertNoBlockingAxeViolations(page);
      });
    }

    test('admin accède aux pages de gestion', async ({ page }) => {
      await page.setViewportSize(viewport);
      await loginAsAdmin(page);

      if (viewport.width <= 768) {
        await page.locator('.menu-toggle').click();
        await expect(page.locator('#primary-navigation')).toHaveClass(/active/);
      }

      await page.locator('.account-menu-toggle').click();
      await expect(page.getByRole('link', { name: 'Gérer les utilisateurs' })).toBeVisible();

      await page.goto('/admin/show_medias', { waitUntil: 'domcontentloaded' });
      await expect(page.getByRole('heading', { level: 1, name: 'Médias' })).toBeVisible();
      await expect(page.locator('tbody tr')).toHaveCount(51);
      await expect(page.locator('h1')).toHaveCount(1);
      await assertNoHorizontalOverflow(page);
      await page.screenshot({
        path: path.join(screenshotsDir, `${viewport.name}-admin.png`),
        fullPage: true
      });
      await assertNoBlockingAxeViolations(page);

      await page.goto('/admin/show_users', { waitUntil: 'domcontentloaded' });
      await expect(page.getByRole('heading', { level: 1, name: 'Utilisateurs' })).toBeVisible();

      await page.goto('/loan/show_loans', { waitUntil: 'domcontentloaded' });
      await expect(page.getByRole('heading', { level: 1, name: 'Gestion des emprunts' })).toBeVisible();
    });

    for (const mediaType of mediaTypes) {
      test(`fiche ${mediaType.name} avec données de démonstration`, async ({ page }) => {
        await page.setViewportSize(viewport);
        const detailUrl = await getMediaDetailUrl(page, mediaType.section);
        await page.goto(detailUrl, { waitUntil: 'domcontentloaded' });

        await expect(page.locator('.media-detail-container')).toBeVisible();
        await expect(page.locator('h1')).toHaveCount(1);
        await expect(page.getByText(mediaType.expectedText)).toBeVisible();
        await assertNoHorizontalOverflow(page);

        if (mediaType.name === 'film') {
          await page.screenshot({
            path: path.join(screenshotsDir, `${viewport.name}-detail.png`),
            fullPage: true
          });
        }

        await assertNoBlockingAxeViolations(page);
      });
    }
  });
}
