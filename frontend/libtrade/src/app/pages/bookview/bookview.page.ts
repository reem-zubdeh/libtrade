import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-bookview',
  templateUrl: './bookview.page.html',
  styleUrls: ['./bookview.page.scss'],
})
export class BookviewPage implements OnInit {

  id:number = 0;
  img:string = "test2_auth.png";
  url:string;
  title:string = "N/A";
  author:string = "N/A";
  available:boolean = false;
  reading:boolean = false;

  constructor(private router: Router) {
    console.log(this.router.getCurrentNavigation().extras.state); 
  }

  ngOnInit() {
  }

}
