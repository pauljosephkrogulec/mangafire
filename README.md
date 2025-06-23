# 📚 MangaStream – Plateforme de Lecture de Mangas en Ligne

Projet fullstack inspiré de [MangaFire](https://mangafire.to), permettant aux utilisateurs de lire des mangas, gérer leurs favoris, et personnaliser leur expérience de lecture.

---

## 🧠 Sommaire

- [Fonctionnalités](#-fonctionnalités)
- [Stack Technique](#-stack-technique)
- [Structure des Entités](#-structure-des-entités)
- [Installation](#-installation)
- [Roadmap](#-roadmap)
- [Crédits](#-crédits)

---

## ✨ Fonctionnalités

### 🎨 Frontend

- Interface responsive avec Next.js et Tailwind CSS
- Page d'accueil : mangas populaires et récents
- Page manga : détails (titre, description, genres, auteur, chapitres)
- Lecteur d’images fluide (scroll ou pagination)
- Système d’authentification JWT
- Gestion des favoris
- Paramètres de lecture (dark/light mode, scroll vertical/horizontal, fit-to-width)
- Reprise automatique de la lecture

### ⚙️ Backend

- API REST avec Symfony 7.2 + API Platform
- Authentification JWT (`lexik/jwt-authentication-bundle`)
- Gestion des utilisateurs, mangas, auteurs, genres, chapitres, pages, favoris
- Endpoints personnalisés (recherche, mangas populaires)
- Filtres, tri et pagination via API Platform
- Fixtures réalistes avec Faker
- Architecture orientée clean code & SOLID

---

## 🧱 Stack Technique

| Côté | Techno |
|------|--------|
| Frontend | Next.js (React 18), Tailwind CSS, SWR, Axios |
| Backend | Symfony **7.2**, API Platform, Doctrine ORM |
| Auth | JWT (LexikJWTAuthenticationBundle) |
| DB | PostgreSQL / MySQL |
| Tests | PHPUnit, Playwright/Cypress |
| DevOps | Docker, GitHub Actions, Vercel |

---

## 🧩 Structure des Entités Principales

### ✅ `User`
- Email, mot de passe, rôles
- Relation : favoris, paramètres de lecture

### ✅ `Manga`
- Titre, description, couverture, auteur, genres
- Relation : chapitres

### ✅ `Genre`
- Nom du genre (Action, Romance, Isekai...)

### ✅ `Author`
- Nom de l’auteur

### ✅ `Chapter`
- Numéro, titre, lien vers `Manga`
- Contient des pages

### ✅ `Page`
- Numéro, image, lien vers `Chapter`

### ✅ `Bookmark`
- Utilisateur, manga, chapitre en cours

### ✅ `ReadingSetting`
- Thème de lecture, direction scroll, zoom automatique

---

## 🚀 Installation

### Prérequis

- PHP 8.2+
- Composer
- Node.js 18+
- Docker
- Symfony CLI

Configurer les environnements backend et frontend selon les instructions dans leurs dossiers respectifs.

---

## 🗺️ Roadmap

- [x] Architecture initiale (entités, relations)
- [x] Authentification JWT
- [x] Fixtures de base
- [x] API REST + pagination/filtrage
- [ ] Upload d'images (admin)
- [ ] Système de commentaires
- [ ] Système de notation
- [ ] Mode hors-ligne (PWA)
- [ ] Mobile App (React Native ou Expo)

---

## 🙌 Crédits

Projet inspiré par :  
- [MangaFire.to](https://mangafire.to)  
- [API Platform](https://api-platform.com)  
- [Next.js](https://nextjs.org)

---

## 📝 Licence

Ce projet est sous licence MIT – libre d'utilisation, modification, distribution.
