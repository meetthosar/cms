## CMS Test

Problem statement

- Build simple CMS
- Content has to be organized by Tags.
- The CMS must have multiple authors.
- Limit users to only edit articles that they created.
- Each user can comment a content.
- An author can upload a related image for each content.
- The CMS also has a REST API interface, for listing, reading and writing contents.
- Use Bootstrap 4 for the frontend.

The Following functionalities are completed:
# Before Login
- Landing page will show all published posts. Posts are shown in random order.
- Posts listing will show post image, post title and post tags.
- By clicking tags, user can view all posts which have that tag
- Right top corner show simple search form which can be used to search post by keywords. It searches in post titles.
- In post listing, Image has link to view single post page.
- I have not added pagination on front side.
- Single post page shows, Post image, post title, post tags, description.
- If image is not available then it shows default image.
- Comment box and other comments are listed below the post details.
- User must login to comment on the post.
- Page top left show menu [Home, Login, Register]

# After Login
- 2 User type: 1. Admin 2. Author.
- One Admin is added.
- After every registration, default user type will be author.
- Admin can view all posts and tags.
- Admin can manage all tags.
- Admin can view and edit other author's posts.
- Author can view only his posts and can edit them.
- Author can choose tags from available list or can add new tags by selecting "Other" option from tags list in create / update post page.
- Author can upload single image for the post. Image is optional for post.
- After login Author will view menu [Posts, Front] on left side of the page.
- Front menu redirects user to landing page.
- Added pagination for posts and tags on backend.

# REST API
Following endpoints are added:

- POST : /api/login - User Login
- GET : /api/listing - Simple Fetching posts
- POST : /api/listing - Simple keyword search for posts
- GET : /api/single/{post_id} - Fetch single post
- POST : /api/post - Store new post. Authentication required.

Instead of any client you can check api endpoints with Feature tests which are added under "tests/Feature/" folder.
