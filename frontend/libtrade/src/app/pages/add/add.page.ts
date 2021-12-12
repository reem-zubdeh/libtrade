import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
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

  constructor(private router: Router, private httpService: HttpService) { }

  ngOnInit() {
  }

  add(form: NgForm) {

    this.error = false;
    this.fd.append('user_id', localStorage.getItem('id'));
    this.fd.append('title', form.value.title);
    this.fd.append('author', form.value.author);
    this.httpService.addBook(this.fd).subscribe(
      response => { 
        this.results = response; 
        for (const res in this.results) {
          if (!this.results[res]) this.error = true;
        }
        if (!this.error) {
          this.router.navigate(["tabs/tabs/books"]);
        }
      }
    );
    
  }

  removeError() {
    this.error = false;
  }

  parseFile(event) {
    this.fd = new FormData();
    let file = <File>event.target.files[0];
    this.fd.append('image', file, file.name);
  }

}
