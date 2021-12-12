import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})
export class ProfilePage implements OnInit {

  img:string = "test2_auth.png";
  url:string;
  first:string = "N/A";
  last:string = "N/A";
  email:string = "N/A";
  phone:string = "N/A";
  city:string = "N/A";

  constructor(private router:Router) { }

  ngOnInit() {
    this.url = "http://" + localStorage.getItem('domain') + "/book_images/" + this.img;
  }

  logout() {
    this.router.navigate(["login"]);
  }

}
