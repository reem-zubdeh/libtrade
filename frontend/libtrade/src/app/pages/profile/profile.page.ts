import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  user;
  img:string = "default.jpg";
  url:string;
  first:string = "N/A";
  last:string = "N/A";
  email:string = "N/A";
  phone:string = "N/A";
  city:string = "N/A";

  constructor(private router:Router, private httpService: HttpService) { }

  ngOnInit() {
    this.httpService.getProfile().subscribe(
      response => {
        this.user = response;
        console.log(response)
        this.first = this.user.first_name;
        this.last = this.user.last_name;
        this.email = this.user.email;
        this.phone = this.user.phone_no;
        this.city = this.user.location;
        this.img = this.user.image_filename;
      }
    );
    this.url = localStorage.getItem('domain') + "/profile_images/" + this.img;
  }

  logout() {
    this.router.navigate(["login"]);
  }

}
