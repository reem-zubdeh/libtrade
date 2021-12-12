import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-add',
  templateUrl: './add.page.html',
  styleUrls: ['./add.page.scss'],
})
export class AddPage implements OnInit {

  constructor() { }

  ngOnInit() {
  }

  add(form: NgForm) {
    console.log(form);
  }

  getFiles(event) {
    console.log(event.target.files);
  }

}
