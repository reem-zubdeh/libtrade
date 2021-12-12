import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-books',
  templateUrl: './books.page.html',
  styleUrls: ['./books.page.scss'],
})
export class BooksPage implements OnInit {

  constructor(private router: Router) { }

  books = [
  {
    title: "aaa",
    author: "zzz",
    image_filename: "cat1.jpg"
  },
  {
    title: "bbb",
    author: "yyy",
    image_filename: "cat2.jpg"
  },
  {
    title: "ccc",
    author: "xxx",
    image_filename: "cat3.jpg"
  },
  {
    title: "ddd",
    author: "www",
    image_filename: "default.jpg"
  }

  ];
  
  add() {
    this.router.navigate(["tabs/tabs/books/add"]);
  }

  ngOnInit() {
  }

}
