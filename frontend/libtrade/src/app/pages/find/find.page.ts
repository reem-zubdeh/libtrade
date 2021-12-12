import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-find',
  templateUrl: './find.page.html',
  styleUrls: ['./find.page.scss'],
})
export class FindPage implements OnInit {

  constructor() { }

  books = [
    {
      book_id: 1,
      title: "aaa",
      author: "zzz",
      image_filename: "cat1.jpg"
    },
    {
      book_id: 2,
      title: "bbb",
      author: "yyy",
      image_filename: "cat2.jpg"
    },
    {
      book_id: 3,
      title: "ccc",
      author: "xxx",
      image_filename: "cat3.jpg"
    }
  
    ];
    
  ngOnInit() {
  }

}
