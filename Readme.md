# GetFlix

GetFlix is a group project about creating a streaming platform web site.
This project is a consolidation challenge, the main goal is to make us practising our new backend skills (PHP, databases, API) and put it together with frontend in a complex project. It is make from 11th July 2022 until 5th August 2022.

---
### Final result

Live version of the project [coming soon](https://swartzflix.herokuapp.com/)!

---
### Group members

- [Arnaud](https://github.com/DalcqArnaud)
- [Asma](https://github.com/asmarighi) 
- [Loïc](https://github.com/loiczeiss)
- [Senait](https://github.com/seninet)

---

## The mission

See original briefing [here](https://github.com/becodeorg/Swartz-6/blob/main/2.The-Hill/2.PHP/GetflixProject.md).

In this exercise you must create a Streaming site in html / css, javascript and php.

Get inspired by Netflix, Amazon Prime Video and other Popcorn Time, Stremio ... The goal is to display a catalog of movies. Spot the similarities between these platforms (navbar, header, search tool, different categories of videos…) See what is cool and what works.

### Must-have features

- A session system: registration, connection / disconnection.
- Different rights: registrants have the right to comment on the content. You can add other rights depending on the different types of users.
- Include a search bar and sort by filters
- Make a secure code
- Deploy the site. PHP is not supported by github, find free alternatives.

### Nice-to-have features

- Management of lost passwords.
- Back office for user and comment management (CRUD).
- Create a page or section that displays the top movies with the movie db API.
- Integrate a newsletter with Mailchimp.

### Miscellanous information

- The videos will not be hosted by you, a simple link to the Youtube trailer will suffice.

---

## The project

### Our working process

- First of all we brainstorm a lot about the design and style of the web site and we agree on it.
- We talked about the technical challenges we will encounter during the project.
- Then we split the final design and challenges into clear tasks using github projects and distribute them between the team members.
- We create the repo of the project and agree on its branch structure. (main > dev > personnal branches for each team member).
- Finally, we start to code the frontend and backend of the web site.

### Challenges

In this project, we encounter different challenges that we have to solve.

- Hosting web site with databases
- Fetch large API datas
- Generate and deal with different databases (accounts, movies)

### Programming languages

For the frontend of this project we will use HTML, CSS and Javascript and for the backend we are planning to use PHP.
We are using theses programming languages beceause they are the ones that we know the best. For the backend, we want to use PHP but the database handling systeme might not be compatible and then we are thinking about refactoring the code with NodeJs.

### Technologies

To be able to host a web site with a database, we found the solution to make the database remote and not local. We are expecting to be able to achieve this by using [Mongodb](https://www.mongodb.com/atlas/database) to make our database remote and then hosting the web site using [Heroku](https://www.heroku.com/). 
To get the movie datas we are using [The Movie Database API](https://developers.themoviedb.org/3/getting-started/introduction).

### Design & style

Here are some sketchs of the design and style we agreed on :

![Home page design](./images/homepage%20design.png)

<details>
<summary>More images :</summary>

![Movies Gallery page design](./images/gallerypage%20design.jpg)

![Home page style](./images/homepage%20style.png)

</details>

---

## How to Contribute 

* Create a personal fork of the project on Github.
* Clone the fork on your local machine. Your remote repo on Github is called `origin`.
* Add the original repository as a remote called `upstream`.
* If you created your fork a while ago be sure to pull upstream changes into your local repository.
* Create a new branch to work on! Branch from `main`.
* Implement/fix your feature, comment your code.
* Follow the code style of the project, including indentation.
* If the project have tests run them!
* Write or adapt tests as needed.
* Add or if any documentation exist change it as needed.
* Squash your commits into a single commit with git's [interactive rebase](https://help.github.com/articles/interactive-rebase). Create a new branch if necessary.
* Push your branch to your fork on Github, the remote `origin`.
* From your fork open a pull request in the correct branch. Target the project's `main`!
* …
* Once the pull request is approved and merged you can pull the changes from `upstream` to your local repo and delete your extra branch(es).

And last but not least: Always write your commit messages in the present tense. Your commit message should describe what the commit, when applied, does to the code – not what you did to the code.

---