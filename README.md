![Homepage](screenshots/homepage.png)

# Web Portal Tempek Klender

## Overview
Web Portal Tempek Klender is a dynamic and interactive web platform designed for the Tempek Klender organization. This portal serves as a centralized hub for members to stay informed about upcoming events, view posts, manage organizational roles, and engage with various features that promote community involvement and efficient management.

## Routes

### General Routes

- **Homepage**
  - `GET /`
  - Loads the welcome page.
  - **Name:** `home`

- **About Page**
  - `GET /about`
  - Loads the about page.
  - **Name:** `about`

### Authenticated Routes

- **Profile**
  - `GET /profile`
  - Loads the user profile page.
  - **Middleware:** `auth`
  - **Name:** `profile`

### Dashboard Routes

- **Dashboard Home**
  - `GET /dashboard`
  - Loads the main dashboard page.
  - **Middleware:** `auth`, `verified`
  - **Name:** `dashboard`

- **Posts Management**
  - `GET /dashboard/posts`
  - Loads the posts management page within the dashboard.
  - **Middleware:** `auth`, `verified`
  - **Name:** `dashboard.posts`

- **Create Post**
  - `POST /dashboard/posts`
  - Handles the creation of new posts.
  - **Middleware:** `auth`, `verified`

- **Edit Post**
  - `GET /dashboard/posts/{post}/edit`
  - Loads the edit post page.
  - **Middleware:** `auth`, `verified`

- **Update Post**
  - `PUT /dashboard/posts/{post}`
  - Handles updating an existing post.
  - **Middleware:** `auth`, `verified`

- **Delete Post**
  - `DELETE /dashboard/posts/{post}`
  - Handles deleting a post.
  - **Middleware:** `auth`, `verified`

- **Members Management**
  - `GET /dashboard/members`
  - Loads the members management page within the dashboard.
  - **Middleware:** `auth`, `verified`
  - **Name:** `dashboard.members`

- **Create Member**
  - `GET /dashboard/members/create`
  - Loads the create member page within the dashboard.
  - **Middleware:** `auth`, `verified`
  - **Name:** `dashboard.members.create`

- **Edit Member**
  - `GET /dashboard/members/{member}/edit`
  - Loads the edit member page within the dashboard.
  - **Middleware:** `auth`, `verified`
  - **Name:** `dashboard.members.edit`

- **Member Photo History**
  - `GET /dashboard/members/{member}/photo_history`
  - Loads the member photo history page within the dashboard.
  - **Middleware:** `auth`, `verified`
  - **Name:** `members.history.photo`

- **Get Members by Name**
  - `GET /dashboard/members/getMembersByName`
  - Fetches members by name for autocomplete or search functionality.
  - **Middleware:** `auth`, `verified`
  - **Name:** `utils.get_members_by_name`

### Role Management Routes

- **Role Manager**
  - `GET /roles`
  - Loads the role manager page.
  - **Name:** `roles.index`

- **Create Role**
  - `GET /roles/create`
  - Loads the create role page.
  - **Name:** `roles.create`

- **Edit Role**
  - `GET /roles/{role}/edit`
  - Loads the edit role page.
  - **Name:** `roles.edit`

### Permission Management Routes

- **Create Permission**
  - `GET /perms/create`
  - Loads the create permission page.
  - **Name:** `perms.create`

### Utility Routes

- **Birthday Reminder**
  - `GET /get-birthday-reminder`
  - Fetches birthday reminders for members.
  - **Controller:** `UtilsController@birthdayReminder`

### Public Routes

- **View Posts**
  - `GET /posts`
  - Loads the page displaying all posts.
  - **Name:** `posts.index`

- **Show Post**
  - `GET /posts/{post}`
  - Loads the page displaying a single post.
  - **Name:** `posts.show`

- **New Member Page**
  - `GET /new-member`
  - Loads the new member registration page.
  - **Name:** `member.create`

- **Gallery**
  - `GET /gallery`
  - Loads the gallery page.
  - **Name:** `gallery`

## Authentication Routes
- The authentication routes are included from an external file, typically managing user login, registration, password reset, etc.
  - **Path:** `require __DIR__ . '/auth.php';`

## Key Features

1. **Homepage**
     ![Homepage](screenshots/homepage.png)
   - A welcoming and intuitive landing page showcasing the latest posts, upcoming events, and announcements.

3. **Create Post**
![Create Post](screenshots/create-post.png)
   - A user-friendly interface allowing authorized members to create and share new posts, complete with text, images, and multimedia content.

4. **Dashboard**
![Dashboard Posts](screenshots/dashbard-posts.png)
   - A comprehensive dashboard offering an overview of the organization's activities, including recent posts, member statistics, and event highlights.

5. **Dashboard - Posts Management**
![Dashboard Members](screenshots/dashboard-members.png)
   - An administrative view where authorized users can manage all posts, including editing, deleting, and updating content.

6. **Dashboard - Members Management**
![Dashboard](screenshots/dashboard.png)
   - A dedicated section for managing member information, viewing member profiles, and updating member roles and permissions.

7. **Edit Member**
 ![Edit Member](screenshots/edit-member.png)
   - A detailed form for editing member profiles, including contact information, roles, and membership status.

8. **Edit Post**
 ![Edit Post](screenshots/edit-posts.png)
   - A streamlined interface for editing existing posts, allowing for quick updates and modifications to keep content relevant and accurate.

9. **Gallery**
![Gallery](screenshots/gallery.png)
   - A visual gallery displaying images from past events, gatherings, and other organizational activities, fostering a sense of community and shared memories.

10. **Member Profile Photo History**
![Member Profile Photo History](screenshots/member-profile-photo-history.png)
   - A feature that maintains a history of profile photos for each member, providing a visual timeline of their engagement with the organization.

11. **Permission Manager**
![Permission Manager](screenshots/permission-manager.png)
    - A powerful tool for managing user permissions, ensuring that members have appropriate access to various features and administrative functions.

12. **Roles Manager**
 ![Roles Manager](screenshots/roles-manager.png)
    - An interface for defining and managing roles within the organization, allowing for customized access levels and responsibilities.

13. **View Member**
![View Member](screenshots/view-member.png)
    - A detailed member profile view, showcasing individual member information, role within the organization, and engagement history.

## Objectives
- **Community Engagement:** Enhance member participation and interaction through a centralized platform for information sharing and event announcements.
- **Efficient Management:** Streamline administrative tasks such as post management, member updates, and role assignments.
- **Transparency and Communication:** Foster a transparent communication channel within the organization, ensuring all members are well-informed and connected.

## Target Audience
- **Organization Members:** Active members looking to stay updated on organizational activities, view posts, and participate in events.
- **Administrators:** Individuals responsible for managing content, member information, and overall platform maintenance.
- **New Members:** Prospective members interested in learning more about Tempek Klender and its community.

By leveraging these features, Web Portal Tempek Klender aims to build a more engaged, informed, and efficiently managed community, ensuring a cohesive and collaborative organizational environment.
