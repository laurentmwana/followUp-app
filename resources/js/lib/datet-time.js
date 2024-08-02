export const MINUTES = 60;
export const HOURS = 60 * MINUTES;
export const DAYS = 24 * HOURS;

/**
 * @param {string | Date} date
 * @returns String
 */
export const ago = (date) => {
    const obj = date instanceof Date ? date : new Date(date);
    const now = new Date();

    const timeDifference = now.getTime() - obj.getTime();
    const secondsDifference = Math.floor(timeDifference / 1000);
    const minutesDifference = Math.floor(secondsDifference / 60);
    const hoursDifference = Math.floor(minutesDifference / 60);
    const daysDifference = Math.floor(hoursDifference / 24);
    const monthsDifference = Math.floor(daysDifference / 30);
    const yearsDifference = Math.floor(monthsDifference / 12);

    if (secondsDifference < 60) {
        return `il y a ${secondsDifference} seconde${
            secondsDifference > 1 ? "s" : ""
        }`;
    } else if (minutesDifference < 60) {
        return `il y a ${minutesDifference} minute${
            minutesDifference > 1 ? "s" : ""
        }`;
    } else if (hoursDifference < 24) {
        return `il y a ${hoursDifference} heure${
            hoursDifference > 1 ? "s" : ""
        }`;
    } else if (daysDifference < 7) {
        return `il y a ${daysDifference} jour${daysDifference > 1 ? "s" : ""}`;
    } else if (monthsDifference < 12) {
        return `il y a ${monthsDifference} mois`;
    } else {
        return `il y a ${yearsDifference} an${yearsDifference > 1 ? "s" : ""}`;
    }
};

/**
 * @param {number} n
 * @returns {String}
 */
const preffix = (n) => (n < 10 ? "0" + n : n);

/**
 *
 * @param {string} start
 */
export const countdown = (start) => {
    // convertir la date qui est string en temps unix
    const lauchDate = Date.parse(start) / 1000;
    // on calcule la difference en seconde entre le 2 dates
    const difference = lauchDate - Date.now() / 1000;
    // on calcule le nombre de jour restant
    const days = Math.floor(difference / DAYS);
    // on calcule le nombre d'heure
    const hours = Math.floor((difference % DAYS) / HOURS);
    // on calcule le nombre de minute
    const minutes = Math.floor((difference % HOURS) / MINUTES);
    // on calcule le nombre de seconde
    const seconds = Math.floor(difference % MINUTES);

    const differences = {
        days: preffix(days),
        hours: preffix(hours),
        minutes: preffix(minutes),
        seconds: preffix(seconds),
    };

    if (difference <= 0) return null;

    window.setTimeout(() => window.requestAnimationFrame(countdown), 1000);

    return differences;
};
