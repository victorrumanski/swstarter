import { useLoaderData, useNavigate } from "react-router-dom";
import Button from "../components/Button/Button";

const api = "https://swapi.dev/api";

export const personLoader = async ({ params }) => {
  const res = await fetch(`${api}/people/${params.id}/?format=json`);
  const resJson = await res.json();
  return resJson;
};

function PersonDetails() {
  const person = useLoaderData();
  const navigate = useNavigate();

  const movies = person.films.map((url) => (
    <li key={url} className="movie-item">
      <a href="#">{url}</a>
    </li>
  ));

  return (
    <div className="details-container ">
      <div className="card">
        <h2>{person.name}</h2>
        <div className="details">
          <div className="fields">
            <h3>Details</h3>
            <p>Birth Year: {person.birth_year}</p>
            <p>Gender: {person.gender}</p>
            <p>Eye Color: {person.eye_color}</p>
            <p>Hair Color: {person.hair_color}</p>
            <p>Height: {person.height}</p>
            <p>Mass: {person.mass}</p>
          </div>
          <div className="movies">
            <h3>Movies</h3>
            {movies}
          </div>
        </div>
        <Button btnText="Retunr to Search" onClick={() => navigate("/")} />
      </div>
    </div>
  );
}
export default PersonDetails;
