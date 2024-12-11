import Button from "../Button/Button";

function Search({
  searchPlaceholder,
  filterType,
  setFilterType,
  term,
  setTerm,
  doSearch,
}) {
  return (
    <div className="search card">
      <p>What are you searching for?</p>
      <form action="" onSubmit={doSearch}>
        <div className="search_type_filter">
          <label>
            <input
              type="radio"
              name="search_type"
              value="people"
              checked={filterType == "people"}
              onChange={(e) => setFilterType("people")}
            />
            <span>People</span>
          </label>

          <label>
            <input
              type="radio"
              name="search_type"
              value="films"
              checked={filterType == "films"}
              onChange={(e) => setFilterType("films")}
            />
            <span>films</span>
          </label>
        </div>
        <input
          type="text"
          value={term}
          placeholder={searchPlaceholder}
          onChange={(e) => setTerm(e.target.value)}
        />
        <Button btnText="Search" disabled={!term} onClick={doSearch} />
      </form>
    </div>
  );
}
export default Search;
