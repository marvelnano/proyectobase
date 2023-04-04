import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { PlantillaComponent } from './plantilla/plantilla.component';
import { DetalleComponent } from './Producto/detalle/detalle.component';
import { ListarComponent } from './Producto/listar/listar.component';
import { MenuComponent } from './Producto/menu/menu.component';

const routes: Routes = [
  {path:'plantilla', component:PlantillaComponent},
  {path:'listar', component:ListarComponent},
  {path:'detalle', component:DetalleComponent},
  {path:'menu', component:MenuComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
