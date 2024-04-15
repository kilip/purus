import { type Session as DefaultSession, type User } from "next-auth";
export interface Session extends DefaultSession {
  error?: "RefreshAccessTokenError";
  accessToken: string;
  idToken: string;
  user?: User;
}
