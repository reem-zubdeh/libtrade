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
    }
  
    ];
    
  ngOnInit() {
  }

}
