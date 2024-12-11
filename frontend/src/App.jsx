import DefaultLayout from "./components/DefaultLayout/DefaultLayout";
import Home from "./pages/Home";
import PersonDetails, { personLoader } from "./pages/PersonDetails.jsx";
import NoPage from "./pages/NoPage.jsx";
import FilmDetails from "./pages/FilmDetails.jsx";
import {
  Route,
  RouterProvider,
  createBrowserRouter,
  createRoutesFromElements,
} from "react-router-dom";
const router = createBrowserRouter(
  createRoutesFromElements(
    <Route element={<DefaultLayout />}>
      <Route index element={<Home />} />
      <Route
        path="/people/:id"
        element={<PersonDetails />}
        loader={personLoader}
      />
      <Route path="/films/:id" element={<FilmDetails />} />
      <Route path="*" element={<NoPage />} />
    </Route>
  )
);
function App() {
  return (
    <>
      <RouterProvider router={router} />
    </>
  );
}

export default App;
