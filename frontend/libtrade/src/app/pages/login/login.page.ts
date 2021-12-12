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
  result;
  error: boolean = false;
  constructor(private router: Router, private httpService: HttpService) { }

  ngOnInit() {
  }
  
  login(form: NgForm) {
    
    this.fd = new FormData();
    this.fd.append('email', form.value.email);
    this.fd.append('password', form.value.password);
    this.httpService.login(this.fd).subscribe(
      response => {
        this.result = response; 
        if (this.result && Object.keys(this.result).length != 0) {
          localStorage.setItem('id', this.result.user_id.toString());
          this.router.navigate(["tabs/tabs/books"]);
        } else {
          this.error = true;
        }
      }
    );

    
  }
  
  removeError() {
    this.error = false;
  }

}
