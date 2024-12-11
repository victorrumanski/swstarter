import { Outlet } from "react-router-dom";
import "./DefaultLayout.scss";

function DefaultLayout() {
  return (
    <div className="layout-container">
      <header>
        <h1>
          <a href="/">SWStarter</a>
        </h1>
      </header>
      <main>
        <Outlet />
      </main>
    </div>
  );
}
export default DefaultLayout;
