let options=[{value:"1",text:"jumper"},{value:"2",text:"Romeo"}];class SelectBox2 extends React.Component{constructor(e){super(e),this.state={value:"Select an Option"}}onChange(e){this.setState({value:e.target.value})}render(){return React.createElement("div",{className:"form-group"},React.createElement("label",{htmlFor:"select2"},"тест"),React.createElement("select",{value:this.state.value,onChange:this.onChange.bind(this),className:"form-control"},options.map(e=>React.createElement("option",{value:e},e))))}}const App=()=>React.createElement("div",{className:"container"},React.createElement("div",{className:"row"},React.createElement("div",{className:"col-sm-4 col-sm-push-4"},React.createElement(SelectBox2,null))));ReactDOM.render(React.createElement(App,null),document.getElementById("app"));
//# sourceMappingURL=script_4.js.map
