import { useCallback, useState } from "react";
import Results from "../components/Home/Results";
import Search from "../components/Home/Search";
import axios from "axios";

function Home() {
  const swURL = "https://swapi.dev/api";
  // const serverURL = "http://localhost:8000/api";
  const serverURL = import.meta.env.VITE_API_URL;

  const [filterType, setFilterType] = useState("people");
  const [term, setTerm] = useState("");
  const placeholderText =
    filterType === "people"
      ? "e.g. Chewbacca, Yoda, Boba Fett"
      : "e.g. The Return Of Jedi";

  const [loading, setLoading] = useState(false);
  const [results, setResults] = useState([]);

  const searchStartWars = async () => {
    try {
      const response = await axios.get(
        `${swURL}/${filterType}?format=json&search=${term}`
      );
      const mergedResults = response.data.results.map(
        ({ url, name, title, ...rest }) => {
          const id = url
            .substring(0, url.length - 1)
            .split("/")
            .pop();
          return filterType === "people"
            ? { name, id, url, resourceType: filterType, ...rest }
            : { name: title, id, url, resourceType: filterType, ...rest };
        }
      );
      setResults(mergedResults);
    } catch (error) {
      console.error(error);
    }
  };

  const saveMetric = async (query) => {
    const obj = {
      metric_type: "star_wars",
      metric_data: query,
    };
    try {
      const response = await axios.post(`${serverURL}/metrics`, obj);
      console.log("save metric response", response);
    } catch (error) {
      console.error(error);
    }
  };

  const doSearch = async (e) => {
    e.preventDefault();
    setResults(null);
    setLoading(true);
    await searchStartWars();
    await saveMetric(`/${filterType}/?search=${term}`);
    setLoading(false);
  };

  return (
    <div className="home">
      <Search
        searchPlaceholder={placeholderText}
        term={term}
        setTerm={setTerm}
        filterType={filterType}
        setFilterType={setFilterType}
        doSearch={doSearch}
      />
      <Results results={results} loading={loading} />
    </div>
  );
}
export default Home;
