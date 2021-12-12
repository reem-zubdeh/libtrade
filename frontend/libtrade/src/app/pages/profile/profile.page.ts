import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  img:string = "default.jpg";
  url:string;
  first:string = "N/A";
  last:string = "N/A";
  email:string = "N/A";
  phone:string = "N/A";
  city:string = "N/A";

  constructor(private router:Router) { }

  ngOnInit() {
    this.url = localStorage.getItem('domain') + "/profile_images/" + this.img;
  }

  logout() {
    this.router.navigate(["login"]);
  }

}
