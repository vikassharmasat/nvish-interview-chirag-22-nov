

## Instructions

Pull or download file and after that create DB with the name of nvish_m

- After it run migration php artisan:migrate --seed.
- Now create multiple users.
- Now just go into role_users table and update any user's role 1 who will be admin.
- Now visit http://localhost/user-manage/public/login and login.
- After that visit http://localhost/user-manage/public/user/list to see all users and their status.
- Now admin will be able to see status button users.
- If any one is visible online than click that button to logout that particular user.
- Incase any user logged in multiple places in that case that button will one by one log out from each system you have to be just refresh page after every logout.
