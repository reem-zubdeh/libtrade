import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { BooksPageRoutingModule } from './books-routing.module';

import { BooksPage } from './books.page';

import { TabsComponent } from 'src/app/components/tabs/tabs.component';
import { BookComponent } from 'src/app/components/book/book.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    BooksPageRoutingModule
  ],
  declarations: [BooksPage, BookComponent, TabsComponent]
})
export class BooksPageModule {}
