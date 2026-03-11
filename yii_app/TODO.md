# Admin Panel Implementation TODO

## Step 1: Database Migrations
- [x] Create migration for `role` field in users table
- [x] Create migration for `messages` table

## Step 2: Update User Model
- [x] Add `role` attribute and validation in extended/User.php
- [x] Add `isAdmin` method

## Step 3: Create Messages Model
- [x] Create Message model class

## Step 4: Modify ContactForm
- [x] Update extended/ContactForm.php to save messages to database

## Step 5: Create AdminController
- [x] Create controller with actions: index, messages, users
- [x] Add delete message action
- [x] Add delete user action

## Step 6: Create Admin Views
- [x] views/admin/index.php
- [x] views/admin/messages.php
- [x] views/admin/users.php

## Step 7: Update Access Control
- [x] Add access rules to AdminController

## Step 8: Update Layout
- [x] Add admin link in navbar for admin users

## Step 9: Run Migrations
- [x] Execute migrations in database

