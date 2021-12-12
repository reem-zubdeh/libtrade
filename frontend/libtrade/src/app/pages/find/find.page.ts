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
      title: "aaa",
      author: "zzz",
      image_filename: "cat1.jpg",
      owned: 6
    },
    {
      title: "bbb",
      author: "yyy",
      image_filename: "cat2.jpg",
      owned: 1
    },
    {
      title: "ccc",
      author: "xxx",
      image_filename: "cat3.jpg",
      owned: 3
    }
  
    ];
    
  ngOnInit() {
  }

}
