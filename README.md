# Evoting, voting platform and election management.

![Vot-min](https://github.com/robmab/Evoting/assets/56076087/1b59e9ee-d6f5-4aaa-9f02-901c0c335720)

Evoting is an electoral voting platform where any registered user can vote in open elections. Administrators will be able to manage when the elections are closed and opened, as well as view the list of voters, results and other functions.

## Features
- Application only accessible to **registered users**. User login and registration system.
- View for **adding** an additional user, **deleting** your user and **modifying** user data, for all users.
  - Admin users will have an additional view to see the **complete list of users** and their information, as well as to know if they have voted in the last call.
- View of the entire **list of political parties**, as well as their information.
- View to **vote**, but only when the poll is opened by an administrator.
- Admin view to **open or close the last call** created by GM.
- View of the **list of results of all call*** sorted by date and points.
- View of political parties that fulfil that their **total votes are greater than the total number of votes cast in the election divided by the number of participating political parties**.

## Control of permissions
- As long as the poll is **closed**, it will not be possible to vote or see the results.
- As long as the poll is **open**, it is not possible to add, delete or modify users. In addition, it is not possible to view results or list users.
- When **the poll closes again**, it will not be possible to register users, or modify users, but **view results** and list users.

## Technologies
-  SQLInjection Protection
> Technology made with manual PHP code to prevent hackers from using login inputs to perform unauthorised SQL operations, such as deleting users.
- Frontend & Backend
> PHP, Javascript Vanilla, CSS. No framework
