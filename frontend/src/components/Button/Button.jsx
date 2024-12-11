import "./Button.scss";

function Button({ btnText, ...props }) {
  return <button {...props}>{btnText}</button>;
}
export default Button;
