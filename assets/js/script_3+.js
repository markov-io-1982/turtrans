function _defineProperty(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const RRS=window.ReactResponsiveSelect.default,{Component:Component}=React;class Form extends Component{constructor(...e){super(...e),_defineProperty(this,"state",{}),_defineProperty(this,"handleSubmit",this.handleSubmit.bind(this)),_defineProperty(this,"handleChange",this.handleChange.bind(this))}handleChange(e){const t={[e.name]:{text:e.text,value:e.value,altered:e.altered}};this.setState({...this.state,...t},()=>console.log("handleChange()",this.state))}handleSubmit(){console.log("handleSubmit()",this.state)}render(){return React.createElement("div",null,React.createElement("form",null,React.createElement(RRS,{name:"make1",options:[{value:"null",text:"Any"},{value:"alfa-romeo",text:"Alfa Romeo"},{text:"BMW",disabled:"BMW"},{value:"fiat",text:"Fiat"},{value:"lexus",text:"Lexus"},{value:"morgan",text:"Morgan"},{value:"subaru",text:"Subaru"}],prefix:"Make1: ",selectedValue:"fiat",onChange:this.handleChange,onSubmit:this.handleSubmit})),React.createElement("pre",null,JSON.stringify(this.state,null,2)))}}ReactDOM.render(React.createElement(Form,null),document.getElementById("root"));
//# sourceMappingURL=script_3+.js.map