import {
    useJsApiLoader,
    GoogleMap,
    Marker,
    DirectionsRenderer,
    Autocomplete
} from '@react-google-maps/api';
import {useEffect, useRef, useState} from 'react'
import PawLoader from "../components/PawLoader";
import Styles from '../styles/GoogleMaps.module.css';

function GoogleMaps({ setLatitud, setLongitud, latitud, longitud }) {
    const { isLoaded } = useJsApiLoader({
        googleMapsApiKey: process.env.API_GOOGLE,
        libraries: ['places']
    });

    const [map, setMap] = useState(/**@type google.maps.Map  */ (null));
    const [direccion, setDireccion] = useState('');
    const [center, setCenter] = useState({ lat: Number(-34.595951217761645), lng: Number(-58.456828095751796) });

    /** @type React.MutableRefObject<HTMLInputElement> */
    const lugar = useRef();

    useEffect(() => {
        if (latitud && longitud) {
            setCenter({
                lat: Number(latitud),
                lng: Number(longitud)
            })
        }
    },[latitud, longitud]);

    if (!isLoaded) return <PawLoader />

    const buscar = async e => {
        e.preventDefault();

        const geocoder = new google.maps.Geocoder();
        try {
            await geocoder.geocode({ 'address': direccion }, function (resultado, status) {
                if (status == 'OK') {
                    setCenter(resultado[0].geometry.location);
                    setLatitud(resultado[0].geometry.location.lat());
                    setLongitud(resultado[0].geometry.location.lng());
                } else {
                }
            });
        } catch (e) {
            console.error(e);
        }
    }

    return (
        <div className={"relative"}>
            <div
                className={Styles.contenedor}
            >
                <label
                    htmlFor={"direccion"}
                    className={"sr-only"}
                >Indique la dirección del evento</label>
                <Autocomplete>
                    <input
                        type={"text"}
                        placeholder={"Ingresar ubicación"}
                        className={Styles.inputs}
                        ref={lugar}
                        onChange={e => setDireccion(e.target.value)}
                        value={direccion}
                        name={"dirección"}
                        id={"direccion"}
                    />
                </Autocomplete>
                <div
                    className={"mt-3 flex space-between w-full items-center"}
                >
                    <button
                        className={Styles.centrar}
                        onClick={ () => map.panTo(center) }
                        type={"button"}
                    >
                        {/* eslint-disable-next-line @next/next/no-img-element */}
                        <img src={"/imgs/location.svg"} alt={"Centrar"} />
                    </button>
                    <button
                        className={Styles.buscar}
                        onClick={buscar}
                        type={"button"}
                    >Buscar</button>
                </div>
            </div>
            <GoogleMap
                center={center}
                zoom={16}
                mapContainerStyle={{ width: '100vw', height: '100vh', maxWidth: "100%", maxHeight: "100%" }}
                options={{
                    zoomControl: true,
                    streetViewControl: false,
                    mapTypeControl: false,
                    fullscreenControl: false,
                }}
                onLoad={map => setMap(map)}
            >
                {direccion && (
                    <>
                        <Marker  position={center}/>
                        <DirectionsRenderer directions={direccion} />
                    </>
                )}
                <Marker  position={center}/>
            </GoogleMap>
        </div>
    )
}

export default GoogleMaps;