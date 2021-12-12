import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-bookview',
  templateUrl: './bookview.page.html',
  styleUrls: ['./bookview.page.scss'],
})
export class BookviewPage implements OnInit {

  id:number;
  url:string;
  title:string;
  author:string;
  available:boolean;
  reading:boolean;

  constructor(private router: Router) {
    let book = this.router.getCurrentNavigation().extras.state; 
    this.id = book.id;
    this.url = book.url;
    this.title = book.title;
    this.author = book.author;
    this.available = book.available;
    this.reading = book.reading;
    console.log(book)
  }

  ngOnInit() {
  }

}
