import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NgForm } from '@angular/forms';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
})
export class SignupPage implements OnInit {

  constructor(private router: Router, private httpService: HttpService) { }

  fd = new FormData();
  results;
  error:boolean = false;

  ngOnInit() {
  }

  signup() {
    this.router.navigate(["login"]);
  }

  add(form: NgForm) {

    this.error = false;
    this.fd.append('email', localStorage.getItem('id'));
    this.fd.append('password', form.value.password);
    this.fd.append('first-name', form.value.first);
    this.fd.append('last-name', form.value.last);
    this.fd.append('phone-no', form.value.last);
    this.fd.append('location', form.value.last);
    this.httpService.signup(this.fd).subscribe(
      response => { 
        this.results = response; 
        for (const res in this.results) {
          if (!this.results[res]) this.error = true;
        }
        if (!this.error) {
          this.router.navigate(["login"]);
        }
      }
    );
    
  }

  removeError() {
    this.error = false;
  }

  parseFile(event) {
    this.fd = new FormData();
    let file = <File>event.target.files[0];
    this.fd.append('image', file, file.name);
  }

}

