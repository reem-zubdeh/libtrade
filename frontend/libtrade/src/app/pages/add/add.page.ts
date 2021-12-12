import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { HttpService } from 'src/app/services/http.service';

@Component({
  selector: 'app-add',
  templateUrl: './add.page.html',
  styleUrls: ['./add.page.scss'],
})

export class AddPage implements OnInit {

  fd = new FormData();
  results;
  error:boolean = false;

  constructor(private httpService: HttpService) { }

  ngOnInit() {
  }

  add(form: NgForm) {

    console.log(form);
    this.fd.append('user_id', localStorage.getItem('id'));
    this.fd.append('title', form.value.title);
    this.fd.append('author', form.value.author);
    this.httpService.addBook(this.fd).subscribe(
      response => { this.results = response; }
    );
    for (const res in this.results) {
      if (res) this.error = true;
    }
  }

  removeError() {
    this.error = false;
  }

  parseFile(event) {
    let file = <File>event.target.files[0];
    this.fd.append('image', file, file.name);
  }

}
