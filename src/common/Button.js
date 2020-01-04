import React from 'react';
import {View,Text,StyleSheet,TextInput,TouchableOpacity,Image,ImageBackground} from 'react-native';
import {widthPercentageToDP as wp, heightPercentageToDP as hp} from 'react-native-responsive-screen';
import images from "../../assets/images";

export default class Button extends React.Component {


    render() {
        let bgColor=this.props.bgColor;
        let textColor=this.props.textColor;
        let imgLeftColor=this.props.imgLeftColor;
        // let imgMiddleColor=this.props.imgLeftColor;
        let imgRightColor=this.props.imgRightColor;
        let btnWidth=this.props.btnWidth||wp(60);
        let btnHeight=this.props.btnHeight||wp(12);
        let btnRadius=this.props.btnRadius||wp(0);
        let btnMarginStart=this.props.btnMarginStart;
        let iconHeight=this.props.iconHeight || hp(4);
        let iconWidth=this.props.iconWidth || wp(4);
        // let iconWidth=this.props.iconWidth||wp(4);
        // let iconPadding=this.props.iconPadding||wp(7);
        let iconMarginRight=this.props.iconMarginRight;
        // let iconHeight=this.props.iconHeight||wp(4);
        // let viewLeftWidth=this.props.viewLeftWidth || wp(12);
        // let viewMiddleWidth=this.props.viewMiddleWidth || wp(66);
        // let viewRightWidth=this.props.viewRightWidth || wp(12);

        return(
            <View style={styles.container} >
                <TouchableOpacity onPress={this.props.onPress} style={[styles.containerTouchable,{backgroundColor:bgColor},{width:btnWidth},{height:btnHeight},{borderRadius:btnRadius},{marginStart:btnMarginStart}]}>
                        <Image style={[styles.img,{tintColor:imgLeftColor},{height:iconHeight},{width:iconWidth},{marginRight:iconMarginRight}]} source={this.props.imgLeft}/>
                        <Text style={[styles.text,{color:textColor}]}>{this.props.title}</Text>
                </TouchableOpacity>
            </View>
        );
    }
}

const styles= StyleSheet.create({
    container:{
        alignItems:'center',
        // backgroundColor:'grey'

    },
    containerTouchable: {
        flexDirection:'row',
        alignItems: 'center',
        justifyContent:'center',
        height: hp(6),
        // width:wp(100),
        // backgroundColor:'red',
        // marginStart:wp(3),
        marginBottom:hp(2),
    },
    imgLeft: {
        // width:wp(10),
        // alignItems:'flex-start',
        // paddingLeft:wp(3),
        // backgroundColor:'pink',

    },
    imgMiddle: {
        // width:wp(60),
        // backgroundColor:'orange',


    },
    imgRight: {
        // backgroundColor:'green',


    },
    img: {
        height:hp(10),
        width:wp(10),
        resizeMode:'contain',
        tintColor:'#fff',
    },
    text: {
        fontSize: wp(4),
        fontWeight:'700',
        color: '#fff',
        textAlign:'center',
        fontFamily:'System',
    }




});


