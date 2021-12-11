import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  error: boolean = false;
  constructor(private router: Router) { }

  ngOnInit() {
  }
  
  login() {
    //check email and pass
    //call login api
    let result = true;
    if (result) {

      localStorage.setItem('loggedIn', "true");
      this.router.navigate(["books"]);
      //update local storage to contain user id
    } else {
      this.error = true;
    }
  }
  
  removeError() {
    this.error = false;
  }

}
