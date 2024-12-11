import Button from "../Button/Button";
import { useNavigate } from "react-router-dom";

const EmptyState = () => {
  return (
    <div className="msg">
      <p>There are zero matches.</p>
      <p>Use the form to search for People or Movies.</p>
    </div>
  );
};
const LoadingState = () => {
  return (
    <div className="msg">
      <p>Searching...</p>
    </div>
  );
};
function Results({ results, loading }) {
  const navigate = useNavigate();
  let nonResult = null;
  if (loading && !results) {
    nonResult = <LoadingState />;
  }

  if (results?.length === 0) {
    nonResult = <EmptyState />;
  }

  const listItems =
    !nonResult &&
    results.map((result) => (
      <li key={result.id} className="result-item">
        <span>{result.name}</span>
        <Button
          btnText="SEE DETAILS"
          onClick={() => navigate(`/${result.resourceType}/${result.id}`)}
        />
      </li>
    ));

  return (
    <div className="results card">
      <h1>Results</h1>
      <hr />
      <ul>{nonResult ? nonResult : listItems}</ul>
    </div>
  );
}
export default Results;
