import NextAuth from "next-auth/next";
import AuthentikProvider from "next-auth/providers/authentik";
import invariant from 'tiny-invariant';

invariant(process.env.OIDC_CLIENT_ID);
invariant(process.env.OIDC_CLIENT_SECRET);
invariant(process.env.OIDC_ISSUER);
invariant(process.env.OIDC_BASE_URL);


const options = {
  providers: [
    AuthentikProvider({
      clientId: process.env.OIDC_CLIENT_ID,
      clientSecret: process.env.OIDC_CLIENT_SECRET,
      issuer: process.env.OIDC_BASE_URL + '/' + process.env.OIDC_ISSUER
    })
  ]
}

const handler = NextAuth(options);

export {
  handler as GET,
  handler as POST
}
