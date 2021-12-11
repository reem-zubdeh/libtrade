import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-books',
  templateUrl: './books.page.html',
  styleUrls: ['./books.page.scss'],
})
export class BooksPage implements OnInit {

  constructor() { }

  books = [
  {
    book_id: 1,
    title: "aaa",
    author: "zzz",
    image_filename: "cat1.jpg",
    available: 0,
    reading: 0
  },
  {
    book_id: 2,
    title: "bbb",
    author: "yyy",
    image_filename: "cat2.jpg",
    available: 0,
    reading: 1
  },
  {
    book_id: 3,
    title: "ccc",
    author: "xxx",
    image_filename: "cat3.jpg",
    available: 1,
    reading: 0
  },
  {
    book_id: 4,
    title: "ddd",
    author: "www",
    image_filename: "default.jpg",
    available: 1,
    reading: 1
  }

  ];
  
  
  ;
  ngOnInit() {
  }

}
