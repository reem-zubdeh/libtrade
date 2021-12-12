import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NgForm } from '@angular/forms';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  fd = new FormData();
  results;
  error: boolean = false;
  constructor(private router: Router, private httpService: HttpService) { }

  ngOnInit() {
  }
  
  login(form: NgForm) {
    //check email and pass
    //call login api
    let result = true;
    if (result) {
      localStorage.setItem('id', result.toString());
      this.router.navigate(["tabs/tabs/books"]);
    } else {
      this.error = true;
    }
  }

  add(form: NgForm) {

    console.log(form);
    this.fd.append('user_id', localStorage.getItem('id'));
    this.fd.append('title', form.value.title);
    this.fd.append('author', form.value.author);
    this.httpService.addBook(this.fd).subscribe(
      response => { this.results = response; }
    );
    for (const res in this.results) {
      if (res) this.error = true;
    }
  }
  
  removeError() {
    this.error = false;
  }

}
