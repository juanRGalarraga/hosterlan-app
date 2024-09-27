export async function formatUrl(baseUrl, dataTosend) {
    if (dataTosend != null) {
        const queryString = await convertBlobsToQueryString(dataTosend);
        baseUrl += "?" + queryString;
    }
    return baseUrl;
}

async function convertBlobsToQueryString(data) {
    const params = new URLSearchParams();

    for (const key in data) {
        console.log(key, data);
        
        if (Array.isArray(data[key])) {
            for (const item of data[key]) {
                if (item instanceof Blob) {
                    const base64 = await blobToBase64(item);
                    params.append(key, base64);
                } else {
                    params.append(key, item);
                }
            }
        } else {
            params.append(key, data[key]);
        }
    }

    return params.toString();
}

function blobToBase64(blob) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result.split(',')[1]);
        reader.onerror = reject;
        reader.readAsDataURL(blob);
    });
}