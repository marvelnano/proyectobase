import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ListarComponent } from './Producto/listar/listar.component';
import { DetalleComponent } from './Producto/detalle/detalle.component';
import { MenuComponent } from './Producto/menu/menu.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { ServiceService } from '../app/Service/service.service';
import { PlantillaComponent } from './plantilla/plantilla.component'


@NgModule({
  declarations: [
    AppComponent,
    ListarComponent,
    DetalleComponent,
    MenuComponent,
    PlantillaComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
